/* user with most expenses */
select u.name , sum(e.amount) as total from users u join expenses e on u.id = e.payerid group by u.id order by total desc limit 1; 


/* colocation with most expenses */
select c.name , sum(e.amount) as total from colocations c join expenses e on c.id = e.colocation_id group by c.id order by total;



select c.name , count(u.id) as user 
from colocations c
join memberships m 
on c.id = m.colocation_id 
join users u 
on u.id = m.user_id 
group by c.id ;