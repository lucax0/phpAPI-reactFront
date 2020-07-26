// ./assets/js/components/votos.js
    
import React, {Component} from 'react';
import axios from 'axios';
import swal from 'sweetalert'
    
function  postComputaVotos(data){
    swal("Chegou a hora de votar!", {
        buttons: {
            cancel : "Fechar",
            naoGostei: {
                text: "Não gosto :(",
                value: "naoGostei"
            },
            gostei: {
                text: "Gostei!! :)",
                value : "gostei"
            }
        }
    }).then((value) => {
        switch (value) {
 
            case "gostei":
              swal("Pronto!", "Seu voto foi enviado com sucesso", "success");
              Votos.render;
              break;
         
            case "naoGostei":
              swal("Pronto!", "Seu voto foi enviado com sucesso", "success");
              break;
    }});    
}

class Votos extends Component {
    constructor() {
        super();
        this.state = { votos: [], loading: true};
    }
    
    componentDidMount() {
        this.getListvotos();
    }
    
    getListvotos() {
       axios.get(`https://localhost:8000/api/listvotos`).then(votos => {
           this.setState({ votos: votos.data, loading: false})
       })
    }

    
    render() {
        const loading = this.state.loading;
        return(
            <div>
                <section className="row-section">
                    <div className="container">
                        <div className="row">
                            <h2 className="text-center"><span>Ranking</span></h2>
                        </div>
                        {loading ? (
                            <div className={'row text-center'}>
                                <span className="fa fa-spin fa-spinner fa-4x"></span>
                            </div>
                        ) : (
                            <div className={'row'}>
                                { this.state.votos.map(votos =>
                                    <div className="col-md-10 offset-md-1 row-block" key={votos.__id}>
                                        <ul __id="sortable">
                                            <li>
                                                <div className="media">
                                                    <div className="media-left align-self-center">
                                                        <img className="rounded-circle"
                                                             src={votos.picture}/>
                                                    </div>
                                                    <div className="media-body">
                                                        <h4>{votos.name}</h4>
                                                        <p>{votos.description}</p>
                                                    </div>
                                                    <div className="media-right align-self-center">
                                                        <button onClick={() => postComputaVotos({votos})} className="btn btn-default">Votar</button>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                )}
                            </div>
                        )}
                    </div>
                </section>
            </div>
        )
    }
}
export default Votos;