import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, UrlTree } from '@angular/router';
import { Observable } from 'rxjs';
import { RouterService } from 'src/app/services/router.service';
import { UsersService } from 'src/app/services/users.service';

@Injectable({
  providedIn: 'root'
})
export class NotViewGuard implements CanActivate {

  constructor(
    private routerService: RouterService,
    private usersService: UsersService
  ) { }

  canActivate(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot
  ): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {

    const user = this.usersService.getUser();
    if (user.role === 'VIEW') {
      this.routerService.goTo('/home');
    }

    return true;
  }

}

