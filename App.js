import React, { Component } from 'react';
import axios from 'axios';
class Form extends Component{

  constructor(props) {
    super(props);
    this.state = {
      'name': '',
      'res' : '',
      }
  }
  
  inputSet = (e) => {
    this.setState({[e.target.name]: e.target.value})
  }
  reg = (e) => {
    e.preventDefault();
    let dat = {
      name: this.state.name,
      'for' : 'insert',
    }
    
    axios.post('https://localhost:443/react_php/index.php', dat).then(response => {
      console.log(response.data);
       if (response.data === 'alham' ) {
         alert('saved')
       } else if (response.data === 'sabr' ) {
         alert('failed')
       }
    })
  }
  render( ) {
    return (
      <div className='container p-5 col-5 mt-3 mb-3 bg-dark text-light' >
        <form className='mb-3' >
          <div className="mb-3">
            <label  className="form-label">name</label>
            <input type="name" onChange={ this.inputSet} className="form-control" name='name' />
          </div>
          <button type="submit" onClick={this.reg} className="btn btn-outline-primary">Submit</button>
        </form>
       <p >{ this.state.name} </p>
      
    </div>
     
    );
  }
}
export default Form;
