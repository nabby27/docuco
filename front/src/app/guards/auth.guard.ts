import { Injectable } from '@angular/core';
import { CanActivate, Router } from '@angular/router';
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
        if (isUserLogged) {
            return true;
        }
        this.router.navigate(['/login'])
        return false;
    }
}
