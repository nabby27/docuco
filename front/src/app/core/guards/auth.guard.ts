import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot, UrlTree, Router } from '@angular/router';
import { Observable } from 'rxjs';
import { UsersService } from 'src/app/services/users.service';

@Injectable({
  providedIn: 'root'
})
export class AuthGuard implements CanActivate {

  constructor(
    private router: Router,
    private usersService: UsersService
  ) { }

  canActivate(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot
  ): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
    this.redirectDependingIfIsLogged(state);

    return true;
  }

  private redirectDependingIfIsLogged(state: RouterStateSnapshot) {
    const isLogged = this.usersService.isLogged();

    this.goToLoginIfUserNotLogged(isLogged, state);
    this.goToHomeIfUserIsLogged(isLogged, state);
  }

  private goToLoginIfUserNotLogged(isLogged: boolean, state: RouterStateSnapshot) {
    if (!isLogged && state.url !== '/login') {
      this.router.navigate(['/login']);
    }
  }

  private goToHomeIfUserIsLogged(isLogged: boolean, state: RouterStateSnapshot) {
    if (isLogged && state.url === '/login') {
      this.router.navigate(['/home']);
    }
  }
}

