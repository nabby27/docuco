import { Observable } from 'rxjs';
import { Token } from '../entities/token';

export interface UsersRepository {

    login(email: string, password: string): Observable<Token>;

}