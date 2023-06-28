import { axiosInstance, tarefasClicaveis, carregarTarefas, criarH5 } from "./helpers.js";

const form = document.querySelector('form');
const divQuadro = document.querySelector('#divQuadro');

form.addEventListener('submit', (e) => {
    e.preventDefault();
    const tarefa = form.inTarefa.value;
    const dado = {tarefa: tarefa};

    const salvar = async () => {
        const resp = await axiosInstance.post('/api/tarefas', dado);
        return resp
    }
    salvar().then((resp) => {
        const h5 = criarH5(resp.data, tarefa);
        divQuadro.appendChild(h5);

        form.inTarefa.value = '';
        form.inTarefa.focus();
    }).catch (() => alert(`${tarefa} já cadastrada!`))
})

form.btnEditar.addEventListener('click', () => {
    const tarefaSelecionada = document.querySelector('.tarefa-selecionada');
    if (!tarefaSelecionada) {
        alert('Selecione uma tarefa para editar!');
        return
    }
    
    const tarefaEmEdicao = document.querySelector('.tarefa-em-edicao');
    console.log(tarefaEmEdicao);
    if (tarefaEmEdicao) {
        const idTarefaEmEdicao = tarefaEmEdicao.children[0].children[0].children[0].children[0].textContent;
        const textoTarefaEmEdicao = tarefaEmEdicao.children[0].children[0].children[0].children[1].textContent;
        const h5 = criarH5(idTarefaEmEdicao, textoTarefaEmEdicao);
        tarefaEmEdicao.replaceWith(h5);
    }
    tarefaSelecionada.className = 'tarefa-em-edicao';
    const tarefaId = tarefaSelecionada.children[0].children[0].textContent;
    
    const frm = document.createElement('form');
    const divFrm = document.createElement('div');
    divFrm.className = 'input-group mb-3'; 

    const input = document.createElement('input');
    input.type = 'text';
    input.className = 'form-control';
    input.value = tarefaSelecionada.innerText;
    input.required = true;

    const spanId = document.createElement('span');
    spanId.hidden = 'hidden';
    spanId.textContent = tarefaId;
    input.appendChild(spanId);

    const spanTarefaOriginal = document.createElement('span');
    spanTarefaOriginal.hidden = 'hidden';
    spanTarefaOriginal.textContent = tarefaSelecionada.innerText;
    input.appendChild(spanTarefaOriginal);

    const divBtnSalvar = document.createElement('div');
    divBtnSalvar.className = 'input-group-append';
    const btnSalvar = document.createElement('input');
    btnSalvar.type = 'submit';
    btnSalvar.className = 'btn btn-success';
    btnSalvar.textContent = 'Salvar';
    
    divBtnSalvar.appendChild(btnSalvar);
    divFrm.appendChild(input);
    divFrm.appendChild(divBtnSalvar);
    frm.appendChild(divFrm);
    tarefaSelecionada.children[0].replaceWith(frm);
    input.focus();
    
    btnSalvar.addEventListener('click', (e) => {
        e.preventDefault();

        if (!input.value) {
            alert('O campo não pode estar vazio!');
            input.focus();
            return
        }

        const dado = {tarefa: input.value};

        const atualizar = async () => {
            const resp = await axiosInstance.put(`/api/tarefas/${tarefaId}`, dado);
            return resp
        }
        atualizar().then((resp) => {
            const h5 = criarH5(tarefaId, input.value);
            tarefaSelecionada.replaceWith(h5);
            form.inTarefa.focus();
        }).catch (() => alert(`${input.value} já cadastrada!`))
    })
})

form.btnRetirar.addEventListener('click', () => {
    const tarefas = document.querySelectorAll('.tarefa');
    
    let aux = -1;
    tarefas.forEach((tarefa, i) => {
        if (tarefa.className === 'row align-middle tarefa tarefa-selecionada') {
            aux = i;
        }
    })

    if (aux === -1) {
        alert('Selecione uma tarefa para removê-la...');
        return
    }

    const deleteId = async (id) => {
        const resp = await axiosInstance.delete(`/api/tarefas/${id}`);
        return resp;
    }
    
    if (confirm(`Confirma a exclusão de ${tarefas[aux].innerText}?`)) {
        deleteId(tarefas[aux].children[0].children[0].textContent)
        .then((resp) => {
            console.log(resp.data);
            divQuadro.removeChild(tarefas[aux]);
        }).catch((error) => {
            console.log(error.response.data);
        });
    }
})

form.btnApagarTudo.addEventListener('click', () => {
    const deletarTodas = async () => {
        const resp = await axiosInstance.delete('/api/tarefas');
        console.log(resp.data);
    }

    if (confirm('Confirma a exclusão de todas as tarefas listadas?')) {
        deletarTodas().then(() => {
            const tarefas = document.querySelectorAll('.tarefa');
    
            tarefas.forEach((tarefa) => {
                divQuadro.removeChild(tarefa);
            })
        }).catch((error) => {
            alert('Não foi possível deletar as tarefas por algum motivo.')
            console.log(error.response.data);
        });
    }
})


window.addEventListener('load', () => {
    carregarTarefas()
    .then((result) => {
        result.data.forEach(dado => {
            const h5 = criarH5(dado['id'], dado['tarefa']);
            divQuadro.appendChild(h5);
        })
    })
})
