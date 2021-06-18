<template>
    <form class="form" @submit.prevent="submit">
        <div class="row">
            <div class="col-sm-3">
                <label for="nome">Nome: </label>
                <input class="form-control" type="text" name="nome" v-model="body.nome" required
                    placeholder="Nome completo do fabricante" />
            </div>
            <div class="col-sm-3">
                <label for="cnpj">CNPJ: </label>
                <the-mask class="form-control" :mask="cnpj" name="cnpj" v-model="body.cnpj" type="text" 
                    :masked="false" placeholder="00.000.000/0000-00" />
            </div>
            <div class="col-sm-3">
                <label for="qtd_dose_disponivel">Quantidade de doses disponiveis: </label>
                <input class="form-control" type="text" name="qtd_dose_disponivel" v-model="body.qtd_dose_disponivel" required
                    onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="00000000" />
            </div>
            <button type="submit" class="btn btn-success h-100" :disabled="disable">
                <span> Cadastrar </span>
            </button>
        </div>
    </form>
</template>
<script>
import { cnpj } from '../../core/masks'

export default {
    name: 'fabricanteCadastro',
    data() {
        return {
            cnpj,
            body: {
                nome: null,
                cnpj: null,
                qtd_dose_disponivel: null
            }
        }
    },
    computed: {
        disable() {
            return !this.body.nome  || !this.body.cnpj 
                || this.body.cnpj.length < 14 || !this.body.qtd_dose_disponivel
        }
    },
    methods: {
        async submit() {
            if (this.disable) return false;

            await this.$inertia.post('/fabricante', this.body);
        }
    }
}
</script>

<style scoped>
    button {
        margin-top: 31px;
    }
</style>