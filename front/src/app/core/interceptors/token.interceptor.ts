import { Injectable } from '@angular/core';
import { HttpRequest, HttpHandler, HttpEvent, HttpInterceptor } from '@angular/common/http';
import { Observable, throwError } from 'rxjs';
import { tap, catchError } from 'rxjs/operators';
import { LogoutAction } from 'src/domain/users/actions/logout.action';
import { RouterService } from 'src/infraestructure/services/router.service';
import { StorageService } from 'src/infraestructure/services/storage.service';
@Injectable({
  providedIn: 'root'
})
export class TokenInterceptor implements HttpInterceptor {

  constructor(
    private routerService: RouterService,
    private storageService: StorageService
  ) { }

  intercept(request: HttpRequest<any>, next: HttpHandler): Observable<HttpEvent<any>> {
    request = request.clone({
      setHeaders: {
        Authorization: `Bearer ` + this.storageService.getToken()?.token
      }
    });

    return next.handle(request).pipe(
      tap((response: any) => {
        return response;
      }),
      catchError((error: any) => {
        if (error.status === 401) {
          const logoutAction = new LogoutAction(this.routerService, this.storageService);
          logoutAction.execute();
        }
        return throwError(error);
      })
    );
  }

}
