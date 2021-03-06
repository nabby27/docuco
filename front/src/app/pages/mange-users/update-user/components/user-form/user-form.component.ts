import { Component, Input, Output, EventEmitter } from '@angular/core';
import { User } from 'src/app/entities/user';
import { FormGroup, FormBuilder, Validators } from '@angular/forms';
import { UsersService } from 'src/app/services/users.service';
import { MatSnackBar } from '@angular/material/snack-bar';
import { Router } from '@angular/router';

@Component({
  selector: 'app-user-form',
  templateUrl: './user-form.component.html',
  styleUrls: ['./user-form.component.scss']
})
export class UserFormComponent {

  @Input() user: User;
  @Output() userUpdated = new EventEmitter();

  userForm: FormGroup;

  constructor(
    private fb: FormBuilder,
    private userService: UsersService,
    private snackBar: MatSnackBar,
    private router: Router,
  ) { }

  ngOnInit() {
    this.setFormData();
  }

  private setFormData() {
    this.userForm = this.fb.group({
      id: [{ value: this.user.id, disabled: false }],
      role: [{ value: this.user.role, disabled: false }, [Validators.required]],
      email: [{ value: this.user.email, disabled: false }, [Validators.required, Validators.email]],
      name: [{ value: this.user.name, disabled: false }, [Validators.required]]
    });
  }

  async update() {
    await this.userService.updateUser(this.userForm.value);
    this.userUpdated.emit();
    this.userForm.reset();
    this.router.navigate(['list-users']);
    this.showMessage('Usuario actualizado');
  }

  private showMessage(message: string) {
    this.snackBar.open(message, null, {
      duration: 5000,
      verticalPosition: 'top'
    });
  }

}
