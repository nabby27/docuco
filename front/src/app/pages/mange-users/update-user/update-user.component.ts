import { Component, OnInit } from '@angular/core';
import { UsersService } from 'src/app/services/users.service';
import { User } from 'src/app/entities/user';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-update-user',
  templateUrl: './update-user.component.html',
  styleUrls: ['./update-user.component.scss']
})
export class UpdateUserComponent implements OnInit {

  userToEdit: User;
  users: User[];

  constructor(
    private activatedRoute: ActivatedRoute,
    private usersService: UsersService
  ) { }

  async ngOnInit() {
    this.getAllUsers();
    const userId = this.activatedRoute.snapshot.paramMap.get('userId');
    this.userToEdit = await this.usersService.getOneUser(userId);
  }

  async getAllUsers() {
    this.users = await this.usersService.getAllUsers();
  }

}
