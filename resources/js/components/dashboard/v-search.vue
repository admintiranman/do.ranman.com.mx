<template>
    <b-field>
        <b-autocomplete
            class="autocomplete-search"
            :data="isLoading ? [] : data"
            v-model="name"
            group-field="type"
            group-options="items"
            placeholder="Realizar una busqueda"
            icon="magnify"
            :loading="isLoading"
            @typing="getAsyncData"
        >

            <template slot-scope="props">
                <a :href="props.option.url" target="_blank" >{{props.option.name}}</a>
            </template>
        </b-autocomplete>
    </b-field>
  
</template>

<script>
import axios from 'axios'
export default {
    
    methods: {
        getAsyncData(name) {
            if(name.length > 4 && !this.isLoading) {            
                this.isLoading = true;
                axios.get("/search", {params: {search: name}})
                .then(({data}) => {
                    console.log(data);
                    this.data = data;
                })
                .finally(() => {
                    this.isLoading = false;
                })
            }
        }

    }, 
    data() {
        return {
            data: [],
            name: '',
            isLoading: false,
        }
    }
}
</script>

<style>
    .autocomplete-search {
        margin: 5px;
        width: 320px;
    }
</style>