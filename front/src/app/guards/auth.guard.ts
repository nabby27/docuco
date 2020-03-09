import { Injectable } from '@angular/core';
import { CanActivate, Router } from '@angular/router';
import { CheckIfUserIsLoggedAction } from 'src/domain/users/actions/CheckIfUserIsLogged.action';
@Injectable({
    providedIn: 'root'
})
export class AuthGuard implements CanActivate {

    checkIfUserIsLoggedAction: CheckIfUserIsLoggedAction;

    constructor(
        private router: Router
    ) {
        this.checkIfUserIsLoggedAction = new CheckIfUserIsLoggedAction();
    }

    canActivate() {
        const isUserLogged = this.checkIfUserIsLoggedAction.execute();
        if (false === isUserLogged) {
            this.router.navigate(['/login'])
        }

        return isUserLogged;
    }
}
