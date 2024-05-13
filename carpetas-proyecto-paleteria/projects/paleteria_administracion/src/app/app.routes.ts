import { NgModule} from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { InicioComponent } from './inicio/inicio.component';
import { TemporalComponent } from './temporal/temporal.component';

export const routes: Routes = [
    {path: '', component: InicioComponent},
    {path: 'inicio', component: InicioComponent},
    {path: 'ejemplito', component: TemporalComponent},
];

@NgModule({
    imports: [ 
        RouterModule.forRoot(routes, { useHash: true }),
    ],
    exports: [ RouterModule],
})

export class AppRoutesModule { }