<template>
    <div>
        <label for="pacientes">Pacientes: </label>
        <select class="custom-select" name="pacientes" id="pacientesSelect" v-model="filtro.cod_paciente">
            <option v-for="(dado, i) in dados" :key="i" :value="dado.id">
                {{ dado.nome }}
            </option>
        </select>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: 'paciente',
    props: {
        filtro: Object,
    },
    data() {
        return {
            dados: []
        }
    },
    created() {
        this.busca();
    },
    methods: {
        busca() {
            axios.get('/api/v1/paciente').then(response => {
                this.dados = response.data
            });
        }
    }
}
</script>