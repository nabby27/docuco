import { Component, OnInit } from '@angular/core';
import { UsersService } from 'src/app/services/users.service';
import { User } from 'src/app/entities/user';

@Component({
  selector: 'app-sidenav',
  templateUrl: './sidenav.component.html',
  styleUrls: ['./sidenav.component.scss']
})
export class SidenavComponent implements OnInit {

  user: User;
  links = [
    {
      text: 'Inicio',
      url: '/home',
      icon: 'dashboard'
    },
    {
      text: 'Añadir documento',
      url: '/add-document',
      icon: 'add_circle_outline',
      role: ['ADMIN', 'EDIT']
    },
    {
      text: 'Administrar usuarios',
      url: '/admin-users',
      icon: 'supervised_user_circle',
      role: ['ADMIN']
    }
  ];

  constructor(
    private usersService: UsersService
  ) { }

  ngOnInit() {
    this.user = this.usersService.getUser();
  }

  userCanAccess(rolesToNeed: string[]) {
    return rolesToNeed.filter(role => role === this.user.role) != [];
  }

}
