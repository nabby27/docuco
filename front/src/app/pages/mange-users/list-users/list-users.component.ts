import { Component, OnInit } from '@angular/core';
import { UsersService } from 'src/app/services/users.service';
import { User } from 'src/app/entities/user';
import { Router } from '@angular/router';

@Component({
  selector: 'app-list-users',
  templateUrl: './list-users.component.html',
  styleUrls: ['./list-users.component.scss']
})
export class ListUsersComponent implements OnInit {

  users: User[];
  userId: number;

  constructor(
    private router: Router,
    private usersService: UsersService
  ) { }

  ngOnInit() {
    this.getAllUsers();
  }

  async getAllUsers() {
    this.users = await this.usersService.getAllUsers();
  }

  goToUpdateUser(user) {
    this.router.navigate(['update-users', user.id]);
  }

  createUser() {
    this.router.navigate(['/create-user']);
  }

}
