import React, { useEffect, useState } from 'react';
import api from '../../api';
import KpiForm from './KpiForm';
export default function KpiManagement(){
  const [kpis,setKpis] = useState([]);
  const fetch = ()=>api.get('/kpis').then(r=>setKpis(r.data)).catch(()=>{});
  useEffect(fetch,[]);
  const del = id=>api.delete(`/kpis/${id}`).then(fetch);
  return (
    <div>
      <h4>KPIs</h4>
      <KpiForm onSuccess={fetch}/>
      <table className="table mt-3">
        <thead><tr><th>#</th><th>Metric</th><th>Score</th><th>Vendor</th><th></th></tr></thead>
        <tbody>
          {kpis.map((k,i)=>(
            <tr key={k.id}><td>{i+1}</td><td>{k.metric}</td><td>{k.score}</td><td>{k.vendor_id}</td><td><button className="btn btn-sm btn-danger" onClick={()=>del(k.id)}>Delete</button></td></tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}
