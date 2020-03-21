import { Component, OnInit } from '@angular/core';
import { UsersService } from 'src/app/services/users.service';
import { User } from 'src/app/entities/user';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-create-user',
  templateUrl: './create-user.component.html',
  styleUrls: ['./create-user.component.scss']
})
export class CreateUserComponent implements OnInit {

  users: User[];

  constructor(
    private usersService: UsersService,
  ) { }

  ngOnInit() {
    this.getAllUsers();
  }

  async getAllUsers() {
    this.users = await this.usersService.getAllUsers();
  }

}
