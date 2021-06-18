const formata = {
    cnpj(value) {
        return value.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/g, "\$1.\$2.\$3/\$4-\$5");
    },
    cpf(value) {
        return value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/g, "\$1.\$2.\$3-\$4");
    },
    telefone(value) {
        return value.replace(/^(\d\d)(\d{5})(\d{4}).*/, "($1) $2-$3");
    },
    rg(value) {
        return value.replace(/^(\d{1,2})(\d{3})(\d{3})([\dX])$/,'$1.$2.$3-$4');
    },
    data(value) {
        return value.split('-').reverse().toString().replace(/,/g, '/');
    }
}

const data = {
    hoje() {
        let date = new Date();
        let dia = date.getDate()
        if (dia < 10) dia = '0'+dia;
        let mes = date.getUTCMonth()
        if (mes < 10) mes = '0'+(mes+1);
        let ano = date.getFullYear()

        return `${ano}-${mes}-${dia}`
    }
}

export { formata, data }