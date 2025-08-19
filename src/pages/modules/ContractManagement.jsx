import React, { useEffect, useState } from 'react';
import api from '../../api';
import ContractForm from './ContractForm';
export default function ContractManagement(){
  const [contracts,setContracts] = useState([]);
  const fetch = ()=>api.get('/contracts').then(r=>setContracts(r.data)).catch(()=>{});
  useEffect(fetch,[]);
  const del = id=>api.delete(`/contracts/${id}`).then(fetch);
  return (
    <div>
      <h4>Contracts</h4>
      <ContractForm onSuccess={fetch}/>
      <table className="table mt-3">
        <thead><tr><th>#</th><th>Title</th><th>Vendor</th><th>Start</th><th>End</th><th></th></tr></thead>
        <tbody>
          {contracts.map((c,i)=>(
            <tr key={c.id}><td>{i+1}</td><td>{c.title}</td><td>{c.vendor_id}</td><td>{c.start_date}</td><td>{c.end_date}</td><td><button className="btn btn-sm btn-danger" onClick={()=>del(c.id)}>Delete</button></td></tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}
