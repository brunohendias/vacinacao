<template>
    <div>
        <label for="vacinas">Vacinas: </label>
        <select class="custom-select" name="vacinas" id="vacinasSelect" v-model="filtro.cod_vacina">
            <option v-for="(dado, i) in dados" :key="i" :value="dado.id" :disabled="dado.qtd_atual == 0">
                {{ dado.nome }}-{{ dado.lote }}
            </option>
        </select>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: 'vacina',
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
            axios.get('/api/v1/vacina').then(response => {
                this.dados = response.data
            });
        }
    }
}
</script>