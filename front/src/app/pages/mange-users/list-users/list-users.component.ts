import { Component, OnInit } from '@angular/core';
import { UsersService } from 'src/app/services/users.service';
import { User } from 'src/app/entities/user';
import { RouterService } from 'src/app/services/router.service';

@Component({
  selector: 'app-list-users',
  templateUrl: './list-users.component.html',
  styleUrls: ['./list-users.component.scss']
})
export class ListUsersComponent implements OnInit {

  users: User[];
  userId: number;

  constructor(
    private routerService: RouterService,
    private usersService: UsersService
  ) { }

  async ngOnInit() {
    this.users = await this.usersService.getAllUsers();
  }

  goToUpdateUser(user) {
    this.routerService.goTo('manage-users', user.id);

  }

}
