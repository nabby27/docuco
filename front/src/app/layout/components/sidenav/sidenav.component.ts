import { Component, OnInit } from '@angular/core';
import { UsersService } from 'src/app/services/users.service';
import { User } from 'src/app/entities/user';

export interface Link {
  text: string;
  url: string;
  icon: string;
  roles: string[];
}

@Component({
  selector: 'app-sidenav',
  templateUrl: './sidenav.component.html',
  styleUrls: ['./sidenav.component.scss']
})
export class SidenavComponent implements OnInit {

  user: User;
  links: Link[] = [
    {
      text: 'Inicio',
      url: '/home',
      icon: 'dashboard',
      roles: ['VIEW', 'EDIT', 'ADMIN']
    },
    {
      text: 'Añadir documento',
      url: '/add-document',
      icon: 'add_circle_outline',
      roles: ['EDIT', 'ADMIN']
    },
    {
      text: 'Administrar usuarios',
      url: '/list-users',
      icon: 'supervised_user_circle',
      roles: ['ADMIN']
    }
  ];

  constructor(
    private usersService: UsersService
  ) { }

  async ngOnInit() {
    this.user = await this.usersService.getCurrentUser();
  }

  userCanAccess(link: Link) {
    return link.roles.filter(role => role === this.user.role).length > 0;
  }

}
