import { Component, OnInit } from '@angular/core';
import { UsersService } from 'src/app/services/users.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent implements OnInit {

  constructor(
    private usersService: UsersService
  ) { }

  ngOnInit() {
  }

  logout() {
    this.usersService.doLogout();
  }
}
