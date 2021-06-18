<template>
    <form class="form" @submit.prevent="submit">
        <div class="row">
            <div class="col-sm-3">
                <label for="nome">Nome: </label>
                <input class="form-control" type="text" name="nome" v-model="body.nome" required
                    placeholder="Nome completo do paciente" />
            </div>
            <div class="col-sm-2">
                <label for="cpf">CPF: </label>
                <the-mask class="form-control" :mask="cpf" name="cpf" v-model="body.cpf" type="text"
                    :masked="false" placeholder="000.000.000-00" />
            </div>
            <div class="col-sm-2">
                <label for="rg">RG: </label>
                <the-mask class="form-control" :mask="rg" name="rg" v-model="body.rg" type="text"
                    :masked="false" placeholder="00.000.000-0" />
            </div>
            <div class="col-sm-3">
                <label for="telefone">Telefone: </label>
                <the-mask class="form-control" :mask="telefone" name="telefone" v-model="body.telefone" type="text"
                    :masked="false" placeholder="(00) 00000-0000" />
            </div>
            <button type="submit" class="btn btn-success h-100" :disabled="disable">
                <span> Cadastrar </span>
            </button>
        </div>
    </form>
</template>

<script>
import { cpf, rg, telefone } from '../../core/masks'

export default {
    name: 'fabricanteCadastro',
    data() {
        return {
            cpf,rg,telefone,
            body: {
                nome: null,
                cpf: null,
                rg: null,
                telefone: null
            }
        }
    },
    computed: {
        disable() {
            return !this.body.nome  || !this.body.cpf || !this.body.rg 
                || !this.body.telefone || this.body.cpf.length < 11 
                || this.body.rg.length < 9 || this.body.telefone.length < 11
        }
    },
    methods: {
        async submit() {
            if (this.disable) return false

            await this.$inertia.post('/paciente', this.body)
        }
    }
}
</script>

<style scoped>
    button {
        margin-top: 31px;
    }
</style>