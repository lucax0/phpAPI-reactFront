// ./assets/js/components/votos.js

import React, { Component } from 'react';
import axios from 'axios';
import swal from 'sweetalert';


class Votos extends Component {
    constructor() {
        super();
        this.state = { votos: [], loading: true };
    }

    componentDidMount() {
        this.getListvotos();
    }

    getListvotos() {
        axios.get(`https://localhost:8000/api/listvotos`).then(votos => {
            this.setState({ votos: votos.data, loading: false })
        })
    }

    alertComputaVotos(data) {
        swal({       

            title: "Chegou a hora de votar!",
            text: `${data.votos.name} tem o Score de:\n Gostei:${(data.votos.positive * 100/(data.votos.positive + data.votos.negative)).toFixed(2)}% Nao Gostei:${(data.votos.negative * 100/(data.votos.positive + data.votos.negative)).toFixed(2)}%`,
            buttons: {
                cancel: "Fechar",
                naoGostei: {
                    text: "Não gostei </3",
                    value: "naoGostei"
                },
                gostei: {
                    text: "Gostei!! <3",
                    value: "gostei"
                }
            }

        }).then((value) => {

            switch (value) {

                case "gostei":
                    this.forceUpdate();                  
                    result = new Promise((resolve, reject) => {
                        resolve(axios.post(`https://localhost:8000/api/edit/${data.votos.__id}/1}`))
                    }).then(resp => {
                        if (resp.status == 200) {
                            swal("Pronto!", "Seu voto foi enviado com sucesso", "success");
                        } else { swal("OPS!", "Seu voto ja foi enviado!", "info"); } 
                    });                                     
                    break;

                case "naoGostei":
                    result = new Promise((resolve, reject) => {
                        resolve(axios.post(`https://localhost:8000/api/edit/${data.votos.__id}/0}`))
                    }).then(resp => {
                        if (resp.status == 200) { //NA API O PHP CONSULTA A SESSION SE TIVER UMA SESSION SIGNIFICA QUE JA FOI VOTADO E RETORNA != 200
                            swal("Pronto!", "Seu voto foi enviado com sucesso", "success");
                        } else { swal("OPS!", "Seu voto ja foi enviado!", "info"); }
                    });
                    break;
            }            
        });
    }

    render() {
        const loading = this.state.loading;
        return (
            <div>
                <section className="row-section">
                    <div className="container">
                        <div className={'row'}>
                            <h2 className="text-center"><span>Ranking</span></h2>
                        </div>
                        {loading ? (
                            <div className={'row text-center'}>
                                <span className="fa fa-spin fa-spinner fa-4x"></span>
                            </div>
                        ) : (
                                <div className={'row'}>
                                    {this.state.votos.map(votos =>
                                        <div className="col-md-10 offset-md-1 row-block" key={votos.__id}>
                                            <ul id="sortable">
                                                <li>
                                                    <div className="media">                                                    
                                                        <div className="media-left align-self-center">
                                                            <img className="rounded-circle"
                                                                src={votos.picture} />
                                                        </div>
                                                        <div className="media-body">
                                                            <h4>{votos.name}</h4>
                                                            <p>{votos.description}</p>
                                                        </div>
                                                        <div className="media-right align-self-center">
                                                            <button onClick={() => this.alertComputaVotos({ votos })} className="btn btn-default">Votar</button>
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