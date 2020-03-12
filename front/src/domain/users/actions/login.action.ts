import { Token } from '../../shared/entities/token';
import { UsersRepositoryInterface } from '../repositories/users.repository.interface';
import { RouterServiceInterface } from 'src/domain/shared/services/router.service.interface';
import { StorageServiceInterface } from 'src/domain/shared/services/storage.service.interface';

export class LoginAction {

  constructor(
    private usersRepository: UsersRepositoryInterface,
    private routerService: RouterServiceInterface,
    private storageService: StorageServiceInterface
  ) { }

  execute(email: string, password: string): Promise<void> {
    return new Promise((resolve, reject) => {
      this.usersRepository.login(email, password).subscribe(
        (token: Token) => {
          this.storageService.saveToken(token);
          this.routerService.goTo('/home');
          resolve();
        },
        () => reject()
      );
    });
  }

}
