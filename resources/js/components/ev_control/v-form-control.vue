<template>
    <form method="post" :action="action" @submit.prevent="validate" ref="form">
        <slot></slot>

        <div class="columns">
            <div class="column">
                <b-field label="Nombre:">
                    <b-input name="name" required></b-input>
                </b-field>
                <fieldset class="fieldset">
                    <legend class="label">Incluir en la evaluación</legend>
                    <section>
                        <b-field v-for="(r, index) in resources" :key="index">
                            <b-checkbox :name="r.name" v-model="r.value">{{r.txt}}</b-checkbox>
                            
                            <b-field label="Año" v-if="r.value && index == 0">
                                <b-input v-model="objetivos_year" name="objetivos_year"  ></b-input>                
                            </b-field>

                        </b-field>
                    </section>
                </fieldset>
            </div>
            
            <div class="column">
                <label for="" class="label">Descripción</label>
                <textarea name="description" id="description" rows="9" class="textarea"></textarea>                    
            </div>
        </div>

        <div class="columns">

            <div class="column">
                <b-field label="Buscar Usuarios">
                    <v-generic-autocomplete placeholder="Buscar por nivel (Director, Gerente...etc) ó por nombre" :options="options" @select="(option) => addUser(option)">

                    </v-generic-autocomplete>
                </b-field>
            </div>
            
            <div class="column">
                <fieldset class="fieldset list-selected" >
                    <legend class="label">Usuarios agregados a la evaluación</legend>
                    <section>
                        <p v-for="s in selected">
                            {{s.name}} <a href="#" @click.prevent="() => deleteUser(s.id)"> Eliminar </a>
                            <input type="hidden" name="users[]" :value="s.id">
                        </p>                
                    </section>
                </fieldset>
            </div>

        </div>


        <div class="buttons">
            <b-button icon-pack="fas" icon-left="save" type="is-primary" native-type="submit">
                Guardar
            </b-button>
        </div>

    
    </form>
</template>

<script>
    export default { 

        props: ["action", "users"], 
        methods: {

            validate() {

                this.$refs.form.submit();

            },

            addUser(opt) {
                if(opt && !this.selected.find(f => f.id == opt.id )) {
                    console.log(this.selected, opt);
                    this.selected = [... new Set([{...opt}].concat([...this.selected]))];        
                }                
            }, 

            deleteUser(id) {
                this.selected  = this.selected.filter(f => f.id != id);
            }


        },          
        data() {
            return {
                objetivos_year: (new Date).getFullYear(),
                search: "", 
                selected: [], 
                options: this.users.map(m=>({...m, id:m.id2})),
                resources: [
                    {name: "objetivos", value: false, txt: "Objetivos"}, 
                    {name: "edp", value: false, txt: "Evaluación Desempeño y Potencial"},
                    {name: "retro", value: false, txt: "Retroalimentación"},
                    {name: "pdi", value: false, txt: "Plan de desarrollo individual"},
                ],
            }
        }

        
    }

</script>


<style lang="scss" scoped>

.list-selected { 
    height: 200px !important;
    max-height: 200px !important;
    overflow-y: scroll;
}

</style>