import { Token } from "../entities/token";
import { User } from "../../users/entities/user";

export interface StorageServiceInterface {

  saveToken(token: Token): void;
  getToken(): Token;
  saveUser(user: User): void;
  getUser(): User;
  clear(): void

}
