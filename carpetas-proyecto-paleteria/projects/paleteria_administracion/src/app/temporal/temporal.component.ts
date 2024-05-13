// ---------  Los imports se queda igual  ------------
// Solo copiar y pegar en el nuevo componente creado
import { Component, ElementRef, OnInit, inject, Renderer2 } from '@angular/core';
import { CommonModule } from '@angular/common';
import { HttpClient, HttpClientModule } from '@angular/common/http';
import { concatMap } from 'rxjs/operators';
import { of } from 'rxjs';
// ---------------------------------------------------

// @Component Depende de cada componente creado
// :: Dejar el que se genera al crear el componente ::
@Component({
  selector: 'app-temporal',
  standalone: true,
  imports: [CommonModule, HttpClientModule],
  templateUrl: './temporal.component.html',
  styleUrls: ['./temporal.component.css'],
})
// ---------------------------------------------------

// export class Depende de cada componente creado
// :: Agregar "implements OnInit" ::
export class TemporalComponent implements OnInit {
  
  // :: Copiar y pegar en el componente creado ::
  httpClient = inject(HttpClient);
  // ---------------------------------------------------

  // datosAPI: any = []; es el arreglo donde se guardan los datos que traigan de la API
  datosAPI: any = [];
  // ---------------------------------------------------
  
  // :: Copiar y pegar en el componente creado ::
  constructor(private elementRef: ElementRef, private renderer: Renderer2) { }
  // ---------------------------------------------------

  // :: Copiar y pegar en el componente creado ::
  ngOnInit(): void {
    this.fetchData().subscribe(() => {
      // Llamar a la función crearDatos después de que se reciban los datos
      this.crearDatos();
    });
  }
  // ---------------------------------------------------

  // :: Copiar y pegar en el componente creado ::
  // Función para obtener los datos de la API
  fetchData() {
    return this.httpClient
      // Cambiar la URL por la de la API que se va a consumir
      .get('http://apicopacabana.com/productos?columnas=*')
      .pipe(
        concatMap((data: any) => {
          console.log(data);
          this.datosAPI = data; // Asigna los datos recibidos a la propiedad data
          return of(null); // Emite un valor nulo después de que se completen los datos
        })
      );
  }

  // Función para crear los elementos HTML con los datos recibidos
  // Cambiar la lógica de esta función según las necesidades del proyecto
  crearDatos() {
    console.log("ESTOY EN CREAR DATOS -----------------");
    console.log(this.datosAPI.datos);
    // Obtener el div con el id de datos
    const datos = this.elementRef.nativeElement.querySelector('#datos');
    // Verifica si hay datos antes de iterar sobre ellos
    if (this.datosAPI.datos && this.datosAPI.datos.length > 0) {
      console.log("Status:",this.datosAPI.status,"\nTitulo:",this.datosAPI.titulo,"\nMensaje:",this.datosAPI.mensaje);
       // Iterar sobre el arreglo data
       this.datosAPI.datos.forEach((item: any) => {
        console.log("ESTOY ACCEDIENDO AL FOR -----------------"); // Aquí puedes hacer lo que necesites con cada elemento del arreglo

        // Aqui se crean los elementos HTML con los datos recibidos
        /*
          El this.renderer.createElement
          sustituye al document.createElement de JavaScript
          this.renderer.{RESTO DEL CÓDIGO} == document.{RESTO DEL CÓDIGO}
        */
        let div = this.renderer.createElement('div');
        this.renderer.addClass(div, 'card');

        let p = this.renderer.createElement('p');
        let text = this.renderer.createText(item.nombre_producto);
        this.renderer.appendChild(p, text);
        this.renderer.appendChild(div, p);

        this.renderer.appendChild(datos, div);
        // ---------------------------------------------------
      });
    } else {
      console.log("No se encontraron datos para mostrar.");
      console.log("Status:",this.datosAPI.status,"\nTitulo:",this.datosAPI.titulo,"\nMensaje:",this.datosAPI.mensaje);
    }
  }
}
