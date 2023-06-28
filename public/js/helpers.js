export const axiosInstance = axios.create({
    baseURL: 'http://localhost:8080',
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Content-type': 'application/json'
    }
})

export const tarefasClicaveis = (h5) => {
    const tarefaSelecionada = document.querySelector('.tarefa-selecionada');
    if (tarefaSelecionada && tarefaSelecionada != h5) {
        tarefaSelecionada.className = 'row align-middle tarefa tarefa-normal';
    }
    
    const tarefaEmEdicao = document.querySelector('.tarefa-em-edicao');
    if (h5 === tarefaEmEdicao) {
        return
    }

    h5.classList.toggle('tarefa-selecionada');
    h5.classList.toggle('tarefa-normal');
}

export const carregarTarefas = async () => {
    try {
        const data = await axiosInstance.get('/api/tarefas');
        return data;
    } catch (error) {
        console.log(error);
    }
}

export const criarH5 = (idTarefa, textoTarefa) => {
    const div = document.createElement('div');
    div.className = 'row align-middle tarefa tarefa-normal';
    const h5 = document.createElement('h5');
    const spanId = document.createElement('span');
    spanId.className = 'id'
    spanId.hidden = 'hidden';
            
    div.addEventListener('click', () => {
        tarefasClicaveis(div);
    });

    const id = document.createTextNode(idTarefa);
    const texto = document.createTextNode(textoTarefa);

    spanId.appendChild(id);
    h5.appendChild(spanId);
    h5.appendChild(texto);
    div.appendChild(h5);
    return div;
}