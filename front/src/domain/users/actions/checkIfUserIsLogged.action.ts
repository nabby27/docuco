import { StorageServiceInterface } from 'src/domain/shared/services/storage.service.interface';

export class CheckIfUserIsLoggedAction {

  constructor(
    private storageService: StorageServiceInterface
  ) { }

  execute(): boolean {
    return this.storageService.getToken() != null;
  }

}
