<template>
    <form class="form" @submit.prevent="submit">
        <div class="row">
            <div class="col-sm-3">
                <label for="nome">Nome: </label>
                <input class="form-control" type="text" name="nome" v-model="body.nome" required
                    placeholder="Nome da vacina" />
            </div>
            <div class="col-sm-3">
                <fabricantes :filtro="body" />
            </div>
            <div class="col-sm-3">
                <label for="qtd_recebida">Quantidade recebida: </label>
                <input class="form-control" type="text" name="qtd_recebida" v-model="body.qtd_recebida" required
                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="00000000" />
            </div>
            <div class="col-sm-3">
                <label for="intervalo_min">Intervalo em dias entre aplicações:</label>
                <input class="form-control" type="text" name="intervalo_min" v-model="body.intervalo_min" required
                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="000" />
            </div>
        </div>
        <div class="row mt-2">
            <div class="col-sm-3">
                <label for="lote">Lote: </label>
                <input class="form-control" type="text" name="lote" v-model="body.lote" required
                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="00000000" />
            </div>
            <div class="col-sm-3">
                <label for="data_validade">Data de validade: </label>
                <input class="form-control" type="date" name="data_validade" v-model="body.data_validade" />
            </div>
            <div class="col-sm-3 h-100 ml-auto text-right">
                <button type="submit" class="btn btn-success" :disabled="disable">
                    <span> Cadastrar </span>
                </button>
            </div>
        </div>
    </form>
</template>
<script>
import fabricantes from '../shared/select/fabricante.vue'

export default {
    name: 'fabricanteCadastro',
    components: {
        fabricantes
    },
    data() {
        return {
            body: {
                nome: null,
                cod_fabricante: null,
                lote: null,
                data_validade: null,
                qtd_recebida: null,
                qtd_atual: null,
                intervalo_min: null
            }
        }
    },
    computed: {
        disable() {
            return !this.body.cod_fabricante  || !this.body.lote
                || !this.body.data_validade || !this.body.qtd_recebida
                || !this.body.intervalo_min || !this.body.nome
        }
    },
    methods: {
        async submit() {
            this.body.qtd_atual = this.body.qtd_recebida
            if (this.disable) return false;

            await this.$inertia.post('/vacina', this.body);
        }
    }
}
</script>

<style scoped>
    button {
        margin-top: 31px;
    }
</style>