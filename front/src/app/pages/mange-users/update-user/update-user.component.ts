import { Component, OnInit, OnDestroy } from '@angular/core';
import { UsersService } from 'src/app/services/users.service';
import { User } from 'src/app/entities/user';
import { ActivatedRoute, Router, NavigationEnd } from '@angular/router';
import { Subscriber, Subscription } from 'rxjs';

@Component({
  selector: 'app-update-user',
  templateUrl: './update-user.component.html',
  styleUrls: ['./update-user.component.scss']
})
export class UpdateUserComponent implements OnInit, OnDestroy {

  userToEdit: User;
  users: User[];

  routerSubscription: Subscription;

  constructor(
    private activatedRoute: ActivatedRoute,
    private usersService: UsersService,
    private router: Router
  ) {
    this.routerSubscription = this.router.events.subscribe(async (event) => {
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

  ngOnDestroy() {
    this.routerSubscription.unsubscribe();
  }

  async getAllUsers() {
    this.users = await this.usersService.getAllUsers();
  }

  createUser() {
    this.router.navigate(['/create-user']);
  }

}
