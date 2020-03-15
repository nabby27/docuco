import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, UrlTree } from '@angular/router';
import { Observable } from 'rxjs';
import { RouterService } from 'src/app/services/router.service';
import { UsersService } from 'src/app/services/users.service';

@Injectable({
  providedIn: 'root'
})
export class AuthGuard implements CanActivate {

  constructor(
    private routerService: RouterService,
    private usersService: UsersService
  ) { }

  canActivate(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot
  ): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
    this.redirectDependingIfIsLogged(state);

    return true;
  }

  // canActivateChild(
  //   next: ActivatedRouteSnapshot,
  //   state: RouterStateSnapshot
  // ): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
  //   this.redirectDependingIfIsLogged(state);

  //   return true;
  // }

  private redirectDependingIfIsLogged(state: RouterStateSnapshot) {
    const isLogged = this.usersService.isLogged();

    this.goToLoginIfUserNotLogged(isLogged, state);
    this.goToHomeIfUserIsLogged(isLogged, state);
  }

  private goToLoginIfUserNotLogged(isLogged: boolean, state: RouterStateSnapshot) {
    if (!isLogged && state.url !== '/login') {
      this.routerService.goTo('/login');
    }
  }

  private goToHomeIfUserIsLogged(isLogged: boolean, state: RouterStateSnapshot) {
    if (isLogged && state.url === '/login') {
      this.routerService.goTo('/home');
    }
  }
}

