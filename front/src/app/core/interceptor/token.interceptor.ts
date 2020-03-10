import { Injectable } from '@angular/core';
import { HttpRequest, HttpHandler, HttpEvent, HttpInterceptor } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { tap, catchError } from 'rxjs/operators';
import { LogoutAction } from 'src/domain/users/actions/logout.action';
import { RouterService } from 'src/infraestructure/services/router.service';
@Injectable({
    providedIn: 'root'
})
export class TokenInterceptor implements HttpInterceptor {

    constructor(
        private routerService: RouterService
    ) { }

    intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
        request = request.clone({
            setHeaders: {
                Authorization: `Bearer ` + localStorage.getItem('token')
            }
        });

        return next.handle(request).pipe(
            tap((response: any) => {
                return response;
            }),
            catchError((error: any) => {
                if (error.status === 401) {
                    const logoutAction = new LogoutAction(this.routerService);
                    logoutAction.execute();
                }
                return throwError(error);
            })
        );
    }

}
