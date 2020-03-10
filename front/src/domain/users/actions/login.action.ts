import { UsersRepository } from '../repositories/users.repository.interface';
import { Token } from '../entities/token';

export class LoginAction {

    constructor(
        private usersRepository: UsersRepository,
    ) { }

    execute(email: string, password: string): Promise<Token> {
        return new Promise((resolve, reject) => {
            this.usersRepository.login(email, password).subscribe(
                (token: Token) => resolve(token),
                () => reject()
            );
        });
    }

}
