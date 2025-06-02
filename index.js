import express from 'express';
import fetch from 'node-fetch';
import cors from 'cors';

const app = express();
app.use(express.json());
app.use(cors()); 

app.post('/crear-transaccion', async (req, res) => {
  const { total } = req.body;
  
  const url = 'https://webpay3gint.transbank.cl/rswebpaytransaction/api/webpay/v1.0/transactions';
  const body = {
    buy_order: 'order00001',
    session_id: 'session00001',
    amount: total,
    return_url: 'https://youtube.com'
  };

  const respuesta = await fetch(url, {
    method: 'POST',
    headers: {
      'Tbk-Api-Key-Id': '597055555532',
      'Tbk-Api-Key-Secret': '579B532A7440BB0C9079DED94D31EA1615BACEB56610332264630D42D0A36B1C',
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(body)
  });

  if (!respuesta.ok) {
    const errorText = await respuesta.text();
    console.error('Error:', errorText);
    return res.status(500).send('Error creando la transacción');
  }

  const data = await respuesta.json();
  console.log('Respuesta de Webpay:', data);

  res.json(data); // Devuelve la respuesta a tu frontend
});

app.listen(3000, () => {
  console.log('Servidor backend corriendo en http://localhost:3000');
});
