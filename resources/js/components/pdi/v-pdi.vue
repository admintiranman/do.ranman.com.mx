<template>
  <div>
    <b-loading :is-full-page="true" v-model="isLoading" :can-cancel="false"></b-loading>
    <b-modal v-model="show_modal" has-modal-card>
      <div class="modal-card">
        <header class="modal-card-head">
            <p class="modal-card-title">
                {{opts[type_add].header}}
            </p>          
        </header>
        <section class="modal-card-body">

          <label class="label">{{opts[type_add].actividad}}</label>
          <textarea class="textarea" cols="30" rows="2" v-model="item.actividad"></textarea>
          
          <template v-if="type_add != 2">
            <label class="label"> ¿Quién lo acompaña ? </label>
            <input type="text" v-model="item.acompaniante" class="input" />
          </template>
          <label for="" class="label"> Fecha </label>
          <input type="text" class="input" v-model="item.fecha" />
          
        </section>
        <footer class="modal-card-foot">
          <b-button label="cerrar" @click="() => {this.show_modal = false;}" />
          <b-button :label="item.edit ? 'Actualizar Actividad' :  'Agregar Actividad'" type="is-primary" @click="Add"/>
        </footer>
      </div>
    </b-modal>
    <div class="table-container">
      <table class="table is-fullwidth is-bordered table-evaluation">
      <thead>
        <tr>
        <th rowspan="2">
          Competencia Conocimiento y/o Experiencia a desarrollar
          <br>
          <button v-if="!lock" class="button is-small is-primary" @click="add_tema">
            <span class="icon">
              <i class="fas fa-plus"></i>
            </span>
            <span>
              Agregar
            </span>
          </button>
        </th>
        <th colspan="4">Práctica 70%</th>
        <th colspan="4">Guía 20%</th>
        <th colspan="3">Capacitación - Formación 10%</th>        
      </tr>
      <tr>
        <th>Asignación crítica</th>
        <th>¿Quién lo acompaña?</th>
        <th>Fecha</th>
        <th>Estatus</th>
        <th>Coaching, Mentoring</th>
        <th>¿Cada cuanto?</th>
        <th>¿Quién lo acompaña?	</th>
        <th>Estatus</th>
        <th>Teoría</th>
        <th>Fecha</th>
        <th>Etatus</th>        
      </tr>
      </thead>
      <tbody>
        <tr v-if="pdi.length == 0">
          <td colspan="13">Sin datos.</td>
        </tr>
        
        <template v-for="(p, index) in pdi">
          <tr :key="index" >         
            <td :rowspan="pdi_row_size(p.detalles) + 1 ">
              
              <b>{{p.tema}}</b>         
              <span v-if="!lock" class="icon is-clickable" @click="() => {edit_tema(p)}">
                <i class="fas fa-edit"></i>
              </span>
              <span v-if="!lock" class="icon is-clickable" @click="() => {delete_tema(p, index)}">
                <i class="fas fa-trash"></i>
              </span>
            </td>
          <td colspan="4">
            <button v-if="!lock" class="button is-small is-primary" type="button" @click="() => open_practica_modal(0, index)">
              <span class="icon">
                <i class="fas fa-add"></i>
              </span>
              <span>
                Agregar Practica
              </span>
            </button>           
          </td>
          <td colspan="4">
            <button v-if="!lock" class="button is-small is-primary" type="button" @click="() => open_practica_modal(1, index)">
              <span class="icon">
                <i class="fas fa-add"></i>
              </span>
              <span>
                Agregar Guia
              </span>
            </button>
          </td>
          <td colspan="4">
            <button v-if="!lock" class="button is-small is-primary" type="button" @click="() => open_practica_modal(2, index)">
              <span class="icon">
                <i class="fas fa-add"></i>
              </span>
              <span>
                Agregar Formación
              </span>
            </button>
          </td>         
          </tr>
          <tr v-for="(o, i2) in  pdi_format(p.detalles)" :key="`${index}.${i2}`">
            <td :style="{backgroundColor: options[o.practica.status]||'#fff'}">
              {{o.practica.actividad}}
              <span v-if="o.practica.actividad && !lock" class="icon is-clickable" @click="() => edit_practica(0, index, i2, o.practica )">
                <i class="fas fa-edit"></i>
              </span>
              <span v-if="o.practica.actividad && !lock" class="icon is-clickable" @click="()=> delete_activity(0, index, i2, o.practica)">
                <i class="fas fa-trash"></i>
              </span>
            </td>
            <td :style="{backgroundColor: options[o.practica.status]||'#fff'}">{{o.practica.acompaniante}}</td>
            <td :style="{backgroundColor: options[o.practica.status]||'#fff'}">{{o.practica.fecha}}</td>
            <td :style="{backgroundColor: options[o.practica.status]||'#fff'}">
              <select v-model="o.practica.status" v-if="o.practica.status">
                <option :value="s" v-for="(s, i) in status" :key="i">{{s}}</option>
              </select>            
            </td>


            <td :style="{backgroundColor: options[o.guia.status]||'#fff'}">
              {{o.guia.actividad}}
              <span v-if="o.guia.actividad && !lock" class="icon is-clickable" @click="() => edit_practica(1, index, i2, o.guia )">
                <i class="fas fa-edit"></i>
              </span>
              <span v-if="o.guia.actividad && !lock" class="icon is-clickable" @click="()=> delete_activity(1, index, i2, o.guia)">
                <i class="fas fa-trash"></i>
              </span>
            </td>
            <td :style="{backgroundColor: options[o.guia.status]||'#fff'}">{{o.guia.acompaniante}}</td>
            <td :style="{backgroundColor: options[o.guia.status]||'#fff'}">{{o.guia.fecha}}</td>
            <td :style="{backgroundColor: options[o.guia.status]||'#fff'}">
              <select v-model="o.guia.status" v-if="o.guia.status">
                <option :value="s" v-for="(s, i) in status" :key="i">{{s}}</option>
              </select>            
            </td>


            <td :style="{backgroundColor: options[o.formacion.status]||'#fff'}">
              {{o.formacion.actividad}}
              <span v-if="o.formacion.actividad && !lock" class="icon is-clickable" @click="() => edit_practica(2, index, i2, o.formacion )">
                <i class="fas fa-edit"></i>
              </span>
              <span v-if="o.formacion.actividad && !lock" class="icon is-clickable" @click="()=> delete_activity(2, index, i2, o.formacion)">
                <i class="fas fa-trash"></i>
              </span>
            </td>

            <td :style="{backgroundColor: options[o.formacion.status]||'#fff'}">{{o.formacion.fecha}}</td>            
            <td :style="{backgroundColor: options[o.formacion.status]||'#fff'}">
              <select v-model="o.formacion.status" v-if="o.formacion.status">
                <option :value="s" v-for="(s, i) in status" :key="i">{{s}}</option>
              </select>            
            </td>         
          </tr>
        </template>
      </tbody>
    </table>
    
    </div>
    <div class="field">      
        <label for="comentarios" class="label">Comentarios adicionales</label>
        <textarea v-if="!lock" v-model="comentarios" name="comentarios" id="comentarios" cols="30" rows="5" class="textarea   "></textarea>            
        <p v-else v-html="comentarios ? comentarios.replace(/\n/g, '<br />') : '<p>Sin comentarios.</p>'">
          
        </p>
    </div>  
    <div class="field" v-if="url_update">
      <div class="buttons">
        <button  @click="save" class="button is-primary">
          <span class="icon">
              <i class="fas fa-save"></i>
          </span>
          <span v-if="!lock">Guardar Plan de desarrollo individual</span>
          <span v-else>
            Actualizar el estatus de actividades
          </span>
        </button>
        <button  @click="sign" class="button is-link" v-if="show_sign_button">
          <span class="icon">
            <i class="fas fa-edit" style="color: #ffffff !important;"></i>
          </span>
          <span>
            Firmar Plan de desarrollo individual
          </span>
        </button>
      </div>
      
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  props: ['body', 'url_update', 'pcomentarios', 'lock', 'profile_id', 'pdi_boss_id', 'pdi_profile_id', 'show_sign_button'],
  computed: {
  },
  methods: {
    sign() {
      axios.put(this.url_update, {sign: true})
      .then(({}) => {
        window.location.reload()
      })
      
    },
    edit_tema(row) {
      this.$buefy.dialog.prompt({
        title: "Editar Tema",
        message: "Escribe el tema", //
        cancelText: "Cancelar", //
        confirmText: "Aceptar", //
        inputAttrs: {
          value: row.tema
        }, //
        onConfirm: (value) => {
          row.tema = value
        } 
      })      
    },
    edit_practica(t, i, i2, d) {
      this.item = {...d, edit: true, index: i2};
      this.index_tema = i;
      this.type_add = t;
      this.show_modal = true;
    },
    open_practica_modal(t,i) {
      this.item = {
        status: 'Por Iniciar'
      };
      this.index_tema = i;
      this.type_add = t;
      this.show_modal = true;
    },

    add_tema() {
      this.$buefy.dialog.prompt({
        title: "Agregar nuevo tema",
        message: "<b>Escribe el nuevo tema</b>", 
        cancelText: "Cancelar", 
        confirmText: "Aceptar", 
        onConfirm: (value) => {
          this.pdi.push({
            tema: value, 
            detalles: {
              practica: [], 
              guia: [],
              formacion: [] 
            }
          })          
        }
      })
    },
    pdi_row_size(it) {
      return [it.practica.length, it.guia.length, it.formacion.length].reduce((a,b) => a>b?a:b);
      
    },
    pdi_format(it) {
      let max_size = this.pdi_row_size(it); //[it.practica.length, it.guia.length, it.formacion.length].reduce((a,b) => a>b?a:b);
      let out = [];
      console.log("pdi_format => ", max_size)
      for(let i=0; i<max_size; i++) {
        out.push({
          practica: it.practica.length > i ? it.practica[i] : {},  
          guia: it.guia.length > i ? it.guia[i] : {} ,
          formacion: it.formacion.length > i ? it.formacion[i] : {}
        });
      }
      console.log(out);
      return out;
    },

    Add() {
      let {index, edit, ...obj} = this.item;
      if(edit) {
        switch(this.type_add) {
          case 0:
              this.pdi[this.index_tema].detalles.practica[index] = obj ;
            break;
          case 1:
            this.pdi[this.index_tema].detalles.guia[index] = obj;
            break;
          case 2:
            this.pdi[this.index_tema].detalles.formacion[index] = obj;
            break;
        }
      }
      else { 
        switch(this.type_add) {
          case 0:
              this.pdi[this.index_tema].detalles.practica.push(this.item);
            break;
          case 1:
            this.pdi[this.index_tema].detalles.guia.push(this.item);
            break;
          case 2:
            this.pdi[this.index_tema].detalles.formacion.push(this.item);
            break;
        }
      }
      this.show_modal = false;
      console.log(this.pdi);
    },
    delete_tema(p ,index) {
      this.$buefy.dialog.confirm({
        message: `¿Desea eliminar el tema <b>${p.tema}</b>?`, //
        type: 'is-danger',
        confirmText: "Eliminar",
        onConfirm: () => {
          this.pdi = this.pdi.filter((_, i) => index != i);
        }
      });
    },
    delete_activity(type, i1,  i2, data) {
      console.log(i1, i2, data);
      this.$buefy.dialog.confirm({
        message: `¿Desea eliminar la actividad <b>${data.actividad}</b>?`, //
        type: 'is-danger',
        confirmText: "Eliminar",
        onConfirm: () => {
          switch(type) {
            case 0: 
              this.pdi[i1].detalles.practica = this.pdi[i1].detalles.practica.filter((_, i) => i2 != i);
            break;
            case 1: 
              this.pdi[i1].detalles.guia = this.pdi[i1].detalles.guia.filter((_, i) => i2 != i);
            break;
            case 2: 
              this.pdi[i1].detalles.formacion = this.pdi[i1].detalles.formacion.filter((_, i) => i2 != i);
            break;
          }
          
        }
      });
    },
    save() {
      this.isLoading = true;
      let isComplete = this.pdi.every(e =>
          e.detalles.practica.every(e2 => e2.status == 'Finalizado')
          &&
          e.detalles.guia.every(e2 => e2.status == 'Finalizado')
          &&
          e.detalles.formacion.every(e2 => e2.status == 'Finalizado')        
      )
      console.log(isComplete);
      axios.put(this.url_update, {body: this.pdi, comentarios: this.comentarios, isComplete})
      .then(({data}) => {
        this.$buefy.toast.open({
          message: "Plan de desarrollo individual guardado correctamente",
          type: "is-success",
          position:'is-bottom',
          duration: 3000
        })
      })
      .finally(() => {this.isLoading = false;})
    }

  },
  mounted() {
    console.log(this.body);
    console.log(this.pdi);
  },
  data() {
    return {
      options: {
        'Finalizado': '#a9d0be', 
        'En Proceso': '#9bc3e6', 
        'Por Iniciar': '#f4b084'
      },
      isLoading: false,
      comentarios: this.pcomentarios||'',
      index_tema: 0,
      item: {},
      show_modal: false,
      type_add: 0,
      pdi: this.body||[], // pdi form
      opts: [
        {header: 'Práctica 70%', actividad: 'Asignación crítica', },
        {header: 'Guía 20%', actividad: 'Coaching, Mentoring', },
        {header: 'Capacitación - Formación 10%', actividad: 'Teoria', }
      ], 
      status: ['Por Iniciar', 'En Proceso', 'Finalizado'],
    };
  },
};
</script>

<style>
.pdi-table {
  margin-top: 15px;
  margin-bottom: 15px;
}
</style>