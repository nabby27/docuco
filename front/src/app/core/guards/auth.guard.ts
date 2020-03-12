import { Injectable } from '@angular/core';
import { CanActivate, CanActivateChild, ActivatedRouteSnapshot, RouterStateSnapshot, UrlTree } from '@angular/router';
import { Observable } from 'rxjs';
import { CheckIfUserIsLoggedAction } from 'src/domain/users/actions/checkIfUserIsLogged.action';
import { StorageService } from 'src/infraestructure/services/storage.service';
import { RouterService } from 'src/infraestructure/services/router.service';

@Injectable({
  providedIn: 'root'
})
export class AuthGuard implements CanActivate, CanActivateChild {

  constructor(
    private routerService: RouterService,
    private storageService: StorageService
  ) { }

  canActivate(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot
  ): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
    this.redirectDependingIfIsLogged(state);

    return true;
  }

  canActivateChild(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot
  ): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree {
    this.redirectDependingIfIsLogged(state);

    return true;
  }

  private redirectDependingIfIsLogged(state: RouterStateSnapshot) {
    const checkIfUserIsLogged = new CheckIfUserIsLoggedAction(this.storageService);
    const isLogged = checkIfUserIsLogged.execute();

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

