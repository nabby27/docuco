export class CheckIfUserIsLoggedAction {

    constructor() { }

    execute(): boolean {
        return localStorage.getItem('token') != null;
    }

}
