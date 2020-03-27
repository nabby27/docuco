import { Component, OnInit, Input } from '@angular/core';
import { UsersService } from 'src/app/services/users.service';
import { User } from 'src/app/entities/user';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.scss']
})
export class HeaderComponent implements OnInit {

  @Input() sidenavElement;
  
  user: User;

  constructor(
    private usersService: UsersService
  ) { }

  async ngOnInit() {
    this.user = await this.usersService.getCurrentUser();
  }

  userCanEdit() {
    return this.usersService.hasPermissionToEdit();
  }
  
  logout() {
    this.usersService.doLogout();
  }
}
