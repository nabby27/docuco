import { Component, OnInit } from '@angular/core';
import { UsersService } from 'src/app/services/users.service';
import { User } from 'src/app/entities/user';
import { ActivatedRoute, Router, NavigationStart, NavigationEnd } from '@angular/router';
import { filter } from 'rxjs/operators';

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
    private usersService: UsersService,
    private router: Router
  ) {
    this.router.events.subscribe(async (event) => {
      if (event instanceof NavigationEnd) {
        this.userToEdit = null;
        const userId = this.activatedRoute.snapshot.paramMap.get('userId');
        this.userToEdit = await this.usersService.getOneUser(userId);
      }
    });
  }

  ngOnInit() {
    this.getAllUsers();
  }

  async getAllUsers() {
    this.users = await this.usersService.getAllUsers();
  }

}
