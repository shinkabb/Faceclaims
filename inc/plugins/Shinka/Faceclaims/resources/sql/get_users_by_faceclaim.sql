SELECT * FROM {$users_table} AS users
LEFT JOIN {$userfields_table} AS userfields ON users.uid = userfields.ufid
WHERE userfields.fid{$faceclaim_fid} != ''
ORDER BY userfields.fid{$faceclaim_fid};