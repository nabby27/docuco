import { Component, OnInit } from '@angular/core';
import { LogoutAction } from 'src/domain/users/actions/logout.action';
import { RouterService } from 'src/infraestructure/services/router.service';

@Component({
    selector: 'app-user-account',
    templateUrl: './user-account.component.html',
    styleUrls: ['./user-account.component.scss']
})
export class UserAccountComponent implements OnInit {

    constructor(
        private routerService: RouterService
    ) { }

    ngOnInit() {
    }

    logout() {
        const logoutAction = new LogoutAction(this.routerService);
        logoutAction.execute();
    }

}
