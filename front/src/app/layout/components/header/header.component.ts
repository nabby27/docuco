import { Component, OnInit } from '@angular/core';
import { UsersService } from 'src/app/services/users.service';
import { User } from 'src/app/entities/user';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent implements OnInit {

  user: User;

  constructor(
    private usersService: UsersService
  ) { }

  ngOnInit() {
    this.user = this.usersService.getUser();
  }

  logout() {
    this.usersService.doLogout();
  }
}
