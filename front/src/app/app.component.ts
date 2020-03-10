import { Component } from '@angular/core';
import { RouterService } from 'src/infraestructure/services/router.service';

@Component({
    selector: 'app-root',
    templateUrl: './app.component.html',
    styleUrls: ['./app.component.scss']
})
export class AppComponent {

    constructor(
        public routerService: RouterService
    ) { }

}
