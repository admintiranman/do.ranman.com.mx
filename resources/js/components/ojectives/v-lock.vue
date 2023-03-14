<template>
    <input :value="value" type="checkbox" :checked="value" @change="() => change_status()" >
</template>

<script>
import axios from 'axios'
import {ToastProgrammatic as Toast} from 'buefy';
export default {
    
    props: ['checked', 'intervalo', 'year'],
    methods:{
        change_status(){
            let v = this.value;
            v = !v;
            axios.post('/admin/objetivos/update', {
                value: v, 
                intervalo: this.intervalo,
                year: this.year
            })
            .then(() => {
                this.value = v;
                Toast.open({type: 'is-success', message: 'Permisos cambiados correctamente', position: 'is-bottom'})
            })
            .catch(() => {
                Toast.open({type: 'is-danger', message: 'Ocurrió un error.', position: 'is-bottom'})
            })
        }
    },
    data() {
        return {
            value: this.checked
        }
    }
}
</script>

<style>

</style>