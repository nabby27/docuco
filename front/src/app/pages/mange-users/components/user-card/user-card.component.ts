import { Component, Input, Output, EventEmitter } from '@angular/core';
import { User } from 'src/app/entities/user';
import { Router } from '@angular/router';
import { UsersService } from 'src/app/services/users.service';
import { MatDialogRef, MatDialog } from '@angular/material/dialog';
import { DialogComponent } from 'src/app/shared/dialog/dialog.component';

@Component({
  selector: 'app-user-card',
  templateUrl: './user-card.component.html',
  styleUrls: ['./user-card.component.scss']
})
export class UserCardComponent {

  @Input() user: User;
  @Output() userRemoved = new EventEmitter();

  dialogRef: MatDialogRef<DialogComponent>;

  constructor(
    private router: Router,
    private usersService: UsersService,
    private dialog: MatDialog
  ) { }

  ngOnInit() {
  }

  goToUpdateUser(user: User) {
    this.router.navigate(['update-users', user.id]);
  }

  async removeUser(user: User) {
    await this.usersService.deleteUser(user);
    this.userRemoved.emit();
    this.router.navigate(['/list-users']);
    this.dialogRef.close();
  }

  openDialog(event: MouseEvent, user: User) {
    event.stopPropagation();
    event.preventDefault();
    this.dialogRef = this.dialog.open(DialogComponent, {
      width: '20vw',
      data: {
        text: `¿Quieres eliminar el usuario '${user.name}'?`,
        clickFn: () => this.removeUser(user)
      }
    });
  }
}
