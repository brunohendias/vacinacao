<template>
    <div>
        <label for="fabricantes">Fabricantes: </label>
        <select class="custom-select" name="fabricantes" id="fabricantesSelect" v-model="filtro.cod_fabricante">
            <option v-for="(dado, i) in dados" :key="i" :value="dado.id" :disabled="dado.qtd_dose_disponivel == 0">
                {{ dado.nome }}
            </option>
        </select>
    </div>
</template>

<script>
import axios from 'axios'

export default {
    name: 'fabricante',
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
            axios.get('/api/v1/fabricante').then(response => {
                this.dados = response.data
            });
        }
    }
}
</script>

<style scoped>
    .sem-dose {
        color: red;
    }
</style>