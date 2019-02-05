import {NgModule} from '@angular/core';
import {Routes, RouterModule} from '@angular/router';
import {LayoutComponent} from './layout.component';

const routes: Routes = [
  {
    path: '',
    component: LayoutComponent,
    children: [
      {path: '', redirectTo: 'postulantes'},
      {path: 'postulantes', loadChildren: './postulantes/postulantes.module#PostulantesModule'},
      {path: 'empresas', loadChildren: './empresas/empresas.module#EmpresasModule'}
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class LayoutRoutingModule {
}
