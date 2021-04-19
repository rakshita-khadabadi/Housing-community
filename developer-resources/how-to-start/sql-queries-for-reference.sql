SELECT b.building_name, a.apartment_number, eb.bill_amount as electricity_bill, 
gb.bill_amount as gas_bill, wb.bill_amount as water_bill,
eb.bill_amount + gb.bill_amount + wb.bill_amount as total
FROM city_view_database.electricity_bills as eb
inner join gas_bills as gb on eb.subdivisions_id = gb.subdivisions_id
inner join water_bills as wb on eb.subdivisions_id = wb.subdivisions_id
inner join buildings as b on b.id = eb.buildings_id
inner join apartments as a on a.id = eb.apartments_id
where eb.subdivisions_id = 21;