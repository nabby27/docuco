import { Component, Input, Output, EventEmitter } from '@angular/core';
import { User } from 'src/app/entities/user';
import { Router } from '@angular/router';
import { UsersService } from 'src/app/services/users.service';

@Component({
  selector: 'app-user-card',
  templateUrl: './user-card.component.html',
  styleUrls: ['./user-card.component.scss']
})
export class UserCardComponent {

  @Input() user: User;

  constructor(
    private router: Router,
    private usersService: UsersService
  ) { }

  ngOnInit() {
  }

  goToUpdateUser(user: User) {
    this.router.navigate(['update-users', user.id]);
  }

  async removeUser(event: MouseEvent, user: User) {
    event.stopPropagation();
    event.preventDefault();
    await this.usersService.deleteUser(user);
    this.router.navigate(['/list-users']);
  }

}
