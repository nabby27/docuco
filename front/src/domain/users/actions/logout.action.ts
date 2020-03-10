import { RouterService } from 'src/infraestructure/services/router.service';

export class LogoutAction {

    constructor(
        // private cacheService: CacheService,
        private routerService: RouterService
    ) { }

    execute(): void {
        localStorage.clear();
        // this.cacheService.clear();
        this.routerService.goTo('login');
    }

}
