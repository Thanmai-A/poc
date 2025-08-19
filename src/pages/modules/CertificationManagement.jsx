import React, { useEffect, useState } from 'react';
import api from '../../api';
import CertificationForm from './CertificationForm';
export default function CertificationManagement(){
  const [certs,setCerts] = useState([]);
  const fetch = ()=>api.get('/certifications').then(r=>setCerts(r.data)).catch(()=>{});
  useEffect(fetch,[]);
  const del = id=>api.delete(`/certifications/${id}`).then(fetch);
  return (
    <div>
      <h4>Certifications</h4>
      <CertificationForm onSuccess={fetch}/>
      <table className="table mt-3">
        <thead><tr><th>#</th><th>Type</th><th>Vendor</th><th>Expiry</th><th></th></tr></thead>
        <tbody>
          {certs.map((c,i)=>(
            <tr key={c.id}><td>{i+1}</td><td>{c.type}</td><td>{c.vendor_id}</td><td>{c.expiry_date}</td><td><button className="btn btn-sm btn-danger" onClick={()=>del(c.id)}>Delete</button></td></tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}
