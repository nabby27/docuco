import { RouterService } from 'src/infraestructure/services/router.service';
import { StorageServiceInterface } from 'src/domain/shared/services/storage.service.interface';

export class LogoutAction {

  constructor(
    // private cacheService: CacheService,
    private routerService: RouterService,
    private storageService: StorageServiceInterface
  ) { }

  execute(): void {
    // this.cacheService.clear();
    this.storageService.clear();
    this.routerService.goTo('login');
  }

}
