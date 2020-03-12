import { Observable } from 'rxjs';
import { Token } from '../../shared/entities/token';

export interface UsersRepositoryInterface {

  login(email: string, password: string): Observable<Token>;

}